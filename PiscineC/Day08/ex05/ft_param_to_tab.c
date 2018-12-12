/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_param_to_tab.c                                  :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/19 18:17:46 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/20 20:07:28 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "ft_stock_par.h"

char				*ft_strdup(char *src)
{
	int				i;
	char			*str;

	i = 0;
	while (src[i] != '\0')
		i++;
	str = (char*)malloc(sizeof(*str) * (i + 1));
	str[i] = '\0';
	i = 0;
	while (src[i] != '\0' || str[i] != '\0')
	{
		str[i] = src[i];
		i++;
	}
	return (str);
}

int					ft_strlen(char *str)
{
	int				i;

	i = 0;
	while (str[i])
		i++;
	return (i);
}

struct s_stock_par	*ft_param_to_tab(int ac, char **av)
{
	t_stock_par		*tab;
	int				i;

	if ((tab = (t_stock_par*)malloc(sizeof(*tab) * (ac + 1))) == NULL)
		return (NULL);
	i = -1;
	while (++i < ac)
	{
		tab[i].str = av[i];
		tab[i].size_param = ft_strlen(av[i]);
		tab[i].copy = ft_strdup(av[i]);
		tab[i].tab = ft_split_whitespaces(av[i]);
	}
	tab[i].str = 0;
	return (tab);
}
