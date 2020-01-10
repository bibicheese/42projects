/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strsplit.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/27 16:14:29 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/23 16:53:02 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

static size_t		ft_len(char const *s, char *c)
{
	size_t		count;
	int			i;

	i = 0;
	count = 0;
	if (s)
	{
		while (ft_iscinstr(c, s[i]))
			i++;
		while (!ft_iscinstr(c, s[i]) && s[i])
		{
			count++;
			i++;
		}
	}
	return (count);
}

static size_t		ft_words(char const *s, char *c)
{
	size_t		count;
	size_t		bool;
	int			i;

	i = 0;
	count = 0;
	bool = 0;
	if (s)
	{
		while (s[i])
		{
			if (ft_iscinstr(c, s[i]))
				bool = 0;
			else
			{
				if (bool == 0)
					count++;
				bool = 1;
			}
			i++;
		}
	}
	return (count);
}

char				**ft_strsplit(char const *s, char *c)
{
	char		**tab;
	char		*str;
	size_t		i;
	size_t		j;

	if (!(tab = (char **)malloc(sizeof(char *) * (ft_words(s, c) + 1))))
		return (NULL);
	str = (char *)s;
	i = 0;
	while (i < ft_words(s, c))
	{
		if (!(tab[i] = (char *)malloc(sizeof(char) * (ft_len(str, c) + 1))))
			return (NULL);
		j = 0;
		while (ft_iscinstr(c, *str))
			str++;
		while (*str && !ft_iscinstr(c, *str))
			tab[i][j++] = *str++;
		tab[i][j] = '\0';
		i++;
	}
	tab[i] = NULL;
	return (tab);
}
