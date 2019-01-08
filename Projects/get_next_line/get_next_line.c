/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/12/05 19:02:50 by jmondino          #+#    #+#             */
/*   Updated: 2019/01/07 16:23:04 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"

char	*ft_malloc_cat(char *s1, char *s2)
{
	char	*str;
	int		i;
	int		j;

	i = -1;
	j = 0;
	str = NULL;
	if (!(s1))
	{
		str = ft_strdup(s2);
		return (str);
	}
	str = (char *)malloc(sizeof(char) * ((ft_strlen(s1) + ft_strlen(s2)) + 1));
	while (s1[++i])
	{
		str[i] = s1[i];
	}
	while (s2[j])
	{
		str[i] = s2[j];
		i++;
		j++;
	}
	str[ft_strlen(s1) + ft_strlen(s2)] = '\0';
	return (str);
}

int		ft_strsearch(char *str, char c)
{
	int		i;

	i = 0;
	if (str)
	{
		while (str[i])
		{
			if (str[i] == c)
				return (1);
			i++;
		}
	}
	return (0);
}

int		ft_cutstr(char *buff, char **str, char **stock)
{
	printf("stock ini = [%s]\n", *stock);
	printf("buff = [%s]\n", buff);
	if (ft_strsearch(*stock, '\n'))
	{
		*str = ft_strsub(*stock, 0, ft_strchr(*stock, '\n') - *stock);
		if (buff)
			*stock = ft_strjoin(ft_strchr(*stock, '\n') + 1, buff);
		else
			*stock = ft_strdup(ft_strchr(*stock, '\n') + 1);
		return (0);
	}
	if (ft_strsearch(buff, '\n'))
	{
		if (*stock)
		{
			*str = ft_strjoin(*stock, ft_strsub(buff, 0, ft_strchr(buff, '\n')
												- buff));
			*stock = ft_strdup(ft_strchr(buff, '\n') + 1);
			return (0);
		}
		*str = ft_strsub(buff, 0, ft_strchr(buff, '\n') - buff);
		*stock = ft_malloc_cat(*stock, (ft_strchr(buff, '\n') + 1));
		return (0);
	}
	*stock = ft_malloc_cat(*stock, buff);
	return (1);
}

int		get_next_line(const int fd, char **line)
{
	static char		*stock;
	char			buff[BUFF_SIZE + 1];
	char			*str;
	int				ret;

	if (fd < 0 || read(fd, buff, 0) == -1)
		return (-1);
	ft_bzero(buff, BUFF_SIZE);
	while ((ret = read(fd, buff, BUFF_SIZE)) > 0)
	{
		if (ft_cutstr(buff, &str, &stock) == 0)
		{
			*line = ft_strdup(str);
			printf("line = [%s]\n\n", *line);
			return (1);
		}
		ft_bzero(buff, BUFF_SIZE);
	}
	if (stock && *stock != '\0')
	{
		if (ft_strsearch(stock, '\n'))
		{
			str = ft_strsub(stock, 0, ft_strchr(stock, '\n') - stock);
			stock = ft_strdup(ft_strchr(stock, '\n') + 1);
			*line = ft_strdup(str);
		}
		else
		{
			*line = ft_strdup(stock);
			stock = NULL;
		}
		if (*line)
			return (1);
	}
	return (0);
}
