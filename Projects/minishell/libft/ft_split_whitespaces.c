/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_split_whitespaces.c                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/18 21:38:37 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/20 02:28:56 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#define SPACES(x) x == ' ' || x == '\n' || x == '\t'
#include <stdlib.h>

int		ft_strleng(char *str)
{
	int		i;
	int		len;

	len = 0;
	i = 0;
	if (str[0] == '\0')
		return (0);
	while (SPACES(str[i]))
		i++;
	while (!(SPACES(str[i])) && str[i])
	{
		len++;
		i++;
	}
	return (len);
}

int		count_word(char *str)
{
	int		i;
	int		j;
	int		bool;

	bool = 0;
	i = 0;
	j = 0;
	if (str[0] == '\0')
		return (0);
	while (str[i])
	{
		if (SPACES(str[i]))
		{
			i++;
			bool = 0;
		}
		else
		{
			if (bool == 0)
				j++;
			bool = 1;
			i++;
		}
	}
	return (j);
}

char	**ft_split_whitespaces(char *str)
{
	int		index;
	int		index_c;
	int		i;
	char	**tab;

	index = 0;
	i = 0;
	if ((tab = (char**)malloc(sizeof(char*) * (count_word(str) + 1))) == NULL)
		return (NULL);
	while (index < count_word(str))
	{
		if ((tab[index] = (char*)malloc(sizeof(char) *
										(ft_strleng(str) + 1))) == NULL)
			return (NULL);
		index_c = 0;
		while (SPACES(str[i]))
			i++;
		while (!(SPACES(str[i])) && str[i])
			tab[index][index_c++] = str[i++];
		tab[index][index_c] = '\0';
		index++;
	}
	tab[index] = NULL;
	return (tab);
}
